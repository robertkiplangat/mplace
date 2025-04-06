import React from "react";

const Footer: React.FC = () => {
  return (
    <footer className="bg-dark text-white text-center py-3 mt-5">
      <p>
        &copy; {new Date().getFullYear()} USIU Marketplace. All rights reserved.
      </p>
    </footer>
  );
};

export default Footer;
