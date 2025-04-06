import React, { useState, useEffect } from "react";

const AdminDashboard: React.FC = () => {
  const [users, setUsers] = useState<any[]>([]);
  const [products, setProducts] = useState<any[]>([]);
  const [error, setError] = useState("");

  useEffect(() => {
    // Fetch users and products from API
    const fetchData = async () => {
      try {
        const usersRes = await fetch("http://localhost:8000/get_users.php");
        const usersData = await usersRes.json();
        setUsers(usersData);

        const productsRes = await fetch(
          "http://localhost:8000/get_products.php"
        );
        const productsData = await productsRes.json();
        setProducts(productsData);
      } catch (err) {
        setError("Failed to fetch data");
      }
    };

    fetchData();
  }, []);

  return (
    <div className="container">
      <h2 className="my-4">Admin Dashboard</h2>
      {error && <div className="alert alert-danger">{error}</div>}

      <h3>Users</h3>
      <ul className="list-group mb-4">
        {users.map((user) => (
          <li key={user.id} className="list-group-item">
            {user.username} - {user.email}
          </li>
        ))}
      </ul>

      <h3>Products</h3>
      <ul className="list-group">
        {products.map((product) => (
          <li key={product.id} className="list-group-item">
            {product.name} - KES {product.price}
          </li>
        ))}
      </ul>
    </div>
  );
};

export default AdminDashboard;
