import React from 'react';

const Product = ({ product, addToCart }) => {
  const handleAddToCart = () => {
    addToCart(product);
  };

  return (
    <div className="product">
      <img src={product.image} alt={product.name} />
      <div className="product-details">
        <p>{product.name}</p>
        <p>${product.price}</p>
        <button onClick={handleAddToCart}>Add to Cart</button>
      </div>
    </div>
  );
};

export default Product;