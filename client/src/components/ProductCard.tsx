import React, { useEffect, useState } from "react";
import { Link } from "react-router-dom";

interface Props {
  productId: number; // You can pass product ID directly as prop
}

const ProductCard: React.FC<Props> = ({ productId }) => {
  const [product, setProduct] = useState<any | null>(null);

  // Fetch product details from the server
  useEffect(() => {
    const fetchProduct = async () => {
      try {
        const res = await fetch(
          `http://localhost:8000/product.php?id=${productId}`
        );
        const data = await res.json();
        if (data.success && data.product) {
          setProduct(data.product); // Assume product data is under `data.product`
        }
      } catch (error) {
        console.error("Error fetching product details:", error);
      }
    };

    fetchProduct();
  }, [productId]);

  if (!product) return <div>Loading...</div>; // Show loading state until the product is fetched

  return (
    <div className="card h-100">
      {product.image_url && (
        <img
          src={product.image_url} // Ensure the backend provides the correct URL for the image
          className="card-img-top"
          alt={product.name}
        />
      )}
      <div className="card-body">
        <h5 className="card-title">{product.name}</h5>
        <p className="card-text">KES {product.price}</p>
        <Link to={`/product/${product.id}`} className="btn btn-primary">
          View Details
        </Link>
      </div>
    </div>
  );
};

export default ProductCard;
