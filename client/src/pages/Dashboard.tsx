import React, { useEffect, useState } from "react";

const Dashboard: React.FC = () => {
  const [user, setUser] = useState<any>(null);
  const [products, setProducts] = useState<any[]>([]);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const storedUser = localStorage.getItem("user");
    if (storedUser) {
      const parsedUser = JSON.parse(storedUser);
      setUser(parsedUser);
      fetchUserProducts(parsedUser.id);
    }
  }, []);

  const fetchUserProducts = async (userId: number) => {
    try {
      const res = await fetch(
        `http://localhost:8000/product.php?user_id=${userId}`
      );
      const data = await res.json();

      // Check if there are products or error
      if (data.error) {
        setError(data.error);
      } else {
        setProducts(data.products || []);
        setError(null);
      }
    } catch (err) {
      console.error("Error loading products", err);
      setError("Error loading products. Please try again later.");
    }
  };

  return (
    <div className="container mt-4">
      {user ? (
        <>
          <h2>Welcome, {user?.username}!</h2>
          <p>Email: {user?.email}</p>
          <hr />
          <h4>Your Products</h4>
          {error && <div className="alert alert-danger">{error}</div>}

          <div className="row">
            {products.length > 0 ? (
              products.map((product) => (
                <div key={product.id} className="col-md-4 mb-3">
                  <div className="card">
                    <img
                      src={
                        product.image_url || "https://via.placeholder.com/150"
                      }
                      className="card-img-top"
                      alt="Product"
                    />
                    <div className="card-body">
                      <h5 className="card-title">{product.name}</h5>
                      <p className="card-text">{product.description}</p>
                    </div>
                  </div>
                </div>
              ))
            ) : (
              <p>No products found.</p>
            )}
          </div>
        </>
      ) : (
        <p>Please log in to view your dashboard.</p>
      )}
    </div>
  );
};

export default Dashboard;
