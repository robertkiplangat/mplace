import React, { useState, useEffect } from "react";

const Notifications: React.FC = () => {
  const [notifications, setNotifications] = useState<any[]>([]);
  const [error, setError] = useState<string>("");
  const [loading, setLoading] = useState<boolean>(true);

  useEffect(() => {
    // Fetch notifications from API
    const fetchNotifications = async () => {
      try {
        const response = await fetch(
          "http://localhost:8000/get_notifications.php"
        );
        if (!response.ok) {
          throw new Error("Failed to fetch notifications");
        }
        const data = await response.json();
        setNotifications(data);
      } catch (err) {
        if (err instanceof Error) {
          setError(err.message || "Error fetching notifications");
        } else {
          setError("Error fetching notifications");
        }
      } finally {
        setLoading(false);
      }
    };

    fetchNotifications();
  }, []);

  return (
    <div className="container">
      <h3>Notifications</h3>
      {loading ? (
        <p>Loading...</p>
      ) : error ? (
        <div className="alert alert-danger">{error}</div>
      ) : notifications.length > 0 ? (
        <ul className="list-group">
          {notifications.map((notification) => (
            <li key={notification.id} className="list-group-item">
              {notification.message}
            </li>
          ))}
        </ul>
      ) : (
        <p>No new notifications</p>
      )}
    </div>
  );
};

export default Notifications;
