import React, { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";

const Marketplace: React.FC = () => {
  const [products, setProducts] = useState<any[]>([]);
  const [query, setQuery] = useState("");
  const navigate = useNavigate();

  const fetchProducts = async () => {
    const endpoint = query
      ? `http://localhost:8000/search.php?q=${encodeURIComponent(query)}`
      : `http://localhost:8000/product.php`;

    try {
      const res = await fetch(endpoint);
      const data = await res.json();
      setProducts(data.products || []);
    } catch (err) {
      console.error("Error fetching products");
    }
  };

  useEffect(() => {
    fetchProducts();
  }, []);

  const handleSearch = (e: React.FormEvent) => {
    e.preventDefault();
    fetchProducts();
  };

  return (
    <div className="container mt-4">
      <h2>Marketplace</h2>

      <form onSubmit={handleSearch} className="input-group mb-4">
        <input
          type="text"
          className="form-control"
          placeholder="Search products..."
          value={query}
          onChange={(e) => setQuery(e.target.value)}
        />
        <button className="btn btn-outline-secondary" type="submit">
          Search
        </button>
      </form>

      <div className="row">
        {products.map((product) => (
          <div key={product.id} className="col-md-3 mb-4">
            <div
              className="card h-100"
              role="button"
              onClick={() => navigate(`/product/${product.id}`)}
            >
              <img
                src={product.image_url || "https://via.placeholder.com/150"}
                className="card-img-top"
                alt={product.name}
              />
              <div className="card-body">
                <h5 className="card-title">{product.name}</h5>
                <p className="card-text text-truncate">{product.description}</p>
                <p className="text-muted">Ksh {product.price}</p>
              </div>
            </div>
          </div>
        ))}
        {products.length === 0 && <p>No products found.</p>}
      </div>
    </div>
  );
};

export default Marketplace;
