import React from 'react';
import { useQuery } from '@apollo/client';
import { gql } from '@apollo/client';

const GET_PRODUCTS_BY_CATEGORY = gql`
 query GetProducts($category: String!) {
    products(category: $category) {
      id
      name
      description
      image
    }
 }
`;


const CategoryPage = ({ category }) => {
  // Use the useQuery hook to fetch products by category
  const { loading, error, data } = useQuery(GET_PRODUCTS_BY_CATEGORY, {
     variables: { category },
  });
 
  if (loading) return <p>Loading...</p>;
  if (error) return <p>Error</p>;
 
  // Destructure products from the data object
  const { products } = data;
 
  return (
     <div className="category-page">
       <h1>{category}</h1>
       <div className="product-list">
         {products.map((product) => (
           <div key={product.id} className="product">
             <img src={product.image} alt={product.name} />
             <div className="product-details">
               <h2>{product.name}</h2>
               <p>{product.description}</p>
               <button>Add to Cart</button>
             </div>
           </div>
         ))}
       </div>
     </div>
  );
};
 
export default CategoryPage;
