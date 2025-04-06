import React from "react";

const Help: React.FC = () => {
  return (
    <div className="container mt-4">
      <h2>Help Center</h2>
      <p>Here are some frequently asked questions:</p>
      <ul>
        <li>
          <strong>How do I post a product?</strong> – Go to Post Product and
          fill in all required details.
        </li>
        <li>
          <strong>How do I contact a seller?</strong> – Go to Messages and start
          a chat with the seller.
        </li>
        <li>
          <strong>Forgot your password?</strong> – Contact support at{" "}
          <a href="mailto:support@usiu.ac.ke">support@usiu.ac.ke</a>
        </li>
      </ul>
    </div>
  );
};

export default Help;
