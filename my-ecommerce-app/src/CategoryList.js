import React from 'react';
import { useQuery } from '@apollo/client';
import { GET_ALL_CATEGORIES } from './queries';

function CategoryList() {
  const { loading, error, data } = useQuery(GET_ALL_CATEGORIES);

  if (loading) return <p>Loading...</p>;
  if (error) return <p>Error: {error.message}</p>;

  return (
    <div>
      <h2>Categories</h2>
      <ul>
        {data.getAllCategories.map(category => (
          <li key={category.id}>{category.name}</li>
        ))}
      </ul>
    </div>
  );
}

export default CategoryList;