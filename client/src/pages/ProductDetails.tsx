import React, { useEffect, useState } from "react";
import { useParams } from "react-router-dom";

const ProductDetails: React.FC = () => {
  const { id } = useParams<{ id: string }>();
  const [product, setProduct] = useState<any>(null);
  const [error, setError] = useState("");

  useEffect(() => {
    const fetchProduct = async () => {
      try {
        const res = await fetch(
          `http://localhost:8000/product.php?prodid=${id}`
        );
        const data = await res.json();
        if (data.product) {
          setProduct(data.product);
        } else {
          setError("Product not found");
        }
      } catch (err) {
        setError("Failed to fetch product");
      }
    };

    fetchProduct();
  }, [id]);

  if (error) return <div className="container mt-4">{error}</div>;
  if (!product) return <div className="container mt-4">Loading...</div>;

  return (
    <div className="container mt-4">
      <div className="row">
        <div className="col-md-6">
          <img
            src={product.image_url || "https://via.placeholder.com/300"}
            alt={product.name}
            className="img-fluid"
          />
        </div>
        <div className="col-md-6">
          <h2>{product.name}</h2>
          <p className="text-muted">Ksh {product.price}</p>
          <p>{product.description}</p>
          <p>
            <strong>Seller:</strong> {product.seller_name}
          </p>
        </div>
      </div>
    </div>
  );
};

export default ProductDetails;
