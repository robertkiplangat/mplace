import React from "react";
import { Link } from "react-router-dom";

const Home: React.FC = () => {
  return (
    <div className="container text-center mt-5">
      <h1>Welcome to USIU Marketplace 🎉</h1>
      <p className="lead">
        Your trusted campus platform to buy and sell products and services
      </p>
      <div className="mt-4">
        <Link to="/login" className="btn btn-primary me-2">
          Login
        </Link>
        <Link to="/register" className="btn btn-outline-primary">
          Register
        </Link>
      </div>
    </div>
  );
};

export default Home;
