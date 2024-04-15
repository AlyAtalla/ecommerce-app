import React from 'react';

const CategoryPage = ({ category, addToCart }) => {
 // Example product data
 const products = [
    { id: 1, name: 'Product 1', price: 100, image: 'product1.jpg' },
    { id: 2, name: 'Product 2', price: 200, image: 'product2.jpg' },
    { id: 3, name: 'Product 3', price: 300, image: 'product3.jpg' },];

 return (
    <div>
      <h1>{category}</h1>
      <div>
        {products.map(product => (
          <div key={product.id}>
            <img src={product.image} alt={product.name} />
            <h2>{product.name}</h2>
            <p>${product.price}</p>
            <button onClick={() => addToCart(product)}>Add to Cart</button>
          </div>
        ))}
      </div>
    </div>
 );
};

export default CategoryPage;