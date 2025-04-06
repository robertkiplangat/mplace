import React, { useEffect, useState } from "react";

const Messages: React.FC = () => {
  const user = JSON.parse(localStorage.getItem("user") ?? "{}");
  const [conversations, setConversations] = useState<any[]>([]);
  const [selectedUser, setSelectedUser] = useState<any>(null);
  const [messages, setMessages] = useState<any[]>([]);
  const [messageText, setMessageText] = useState("");

  useEffect(() => {
    fetch(`http://localhost:8000/messages.php?user_id=${user.id}`)
      .then((res) => res.json())
      .then((data) => setConversations(data.users || []));
  }, [user.id]);

  const loadMessages = async (withUserId: number) => {
    const res = await fetch(
      `http://localhost:8000/message_exchange.php?from=${user.id}&to=${withUserId}`
    );
    const data = await res.json();
    setSelectedUser(withUserId);
    setMessages(data.messages || []);
  };

  const sendMessage = async () => {
    if (!messageText.trim()) return;

    await fetch(`http://localhost:8000/send_message.php`, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        sender_id: user.id,
        receiver_id: selectedUser,
        message: messageText,
      }),
    });

    setMessageText("");
    loadMessages(selectedUser); // reload messages
  };

  return (
    <div className="container mt-4">
      <h2>Messages</h2>
      <div className="row">
        <div className="col-md-4 border-end">
          <h5>Chats</h5>
          {conversations.map((u) => (
            <div
              key={u.id}
              className={`p-2 border-bottom ${
                selectedUser === u.id ? "bg-light" : ""
              }`}
              role="button"
              onClick={() => loadMessages(u.id)}
            >
              {u.username}
            </div>
          ))}
        </div>
        <div className="col-md-8">
          {selectedUser ? (
            <>
              <div style={{ maxHeight: 300, overflowY: "auto" }}>
                {messages.map((msg, index) => (
                  <div
                    key={index}
                    className={`mb-2 p-2 rounded ${
                      msg.sender_id === user.id
                        ? "bg-primary text-white text-end"
                        : "bg-light"
                    }`}
                  >
                    {msg.message}
                  </div>
                ))}
              </div>
              <div className="mt-3 d-flex">
                <input
                  className="form-control me-2"
                  value={messageText}
                  onChange={(e) => setMessageText(e.target.value)}
                  placeholder="Type message..."
                />
                <button className="btn btn-success" onClick={sendMessage}>
                  Send
                </button>
              </div>
            </>
          ) : (
            <p>Select a user to start chatting.</p>
          )}
        </div>
      </div>
    </div>
  );
};

export default Messages;
