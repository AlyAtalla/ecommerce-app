import React, { useState } from 'react';
import { useMutation } from '@apollo/client';
import { CREATE_CATEGORY } from './mutations';

function CategoryForm() {
  const [name, setName] = useState('');
  const [description, setDescription] = useState('');

  const [createCategory] = useMutation(CREATE_CATEGORY);

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      await createCategory({
        variables: { input: { name, description } },
      });
      // Reset form fields after successful mutation
      setName('');
      setDescription('');
    } catch (error) {
      console.error('Error creating category:', error);
    }
  };

  return (
    <form onSubmit={handleSubmit}>
      <input
        type="text"
        placeholder="Category Name"
        value={name}
        onChange={(e) => setName(e.target.value)}
      />
      <input
        type="text"
        placeholder="Category Description"
        value={description}
        onChange={(e) => setDescription(e.target.value)}
      />
      <button type="submit">Add Category</button>
    </form>
  );
}

export default CategoryForm;