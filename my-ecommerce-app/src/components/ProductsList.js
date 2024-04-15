import React from 'react';
import Product from './Product';

const ProductsList = ({ products, addToCart }) => {
  return (
    <div className="products-list">
      {products.map((product) => (
        <Product key={product.id} product={product} addToCart={addToCart} />
      ))}
    </div>
  );
};

export default ProductsList;