import React from "react";

const About: React.FC = () => {
  return (
    <div className="container mt-4">
      <h2>About USIU Marketplace</h2>
      <p>
        This platform was built for the USIU community to help students buy,
        sell, and exchange items on campus with ease.
      </p>
      <p>Features include:</p>
      <ul>
        <li>Account creation and login</li>
        <li>Product listing and search</li>
        <li>Secure private messaging</li>
        <li>Admin tools (coming soon)</li>
      </ul>
    </div>
  );
};

export default About;
