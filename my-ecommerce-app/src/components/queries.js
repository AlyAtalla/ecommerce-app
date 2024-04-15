import { gql } from '@apollo/client';

export const GET_ALL_CATEGORIES = gql`
  query GetAllCategories {
    getAllCategories {
      id
      name
      description
    }
  }
`;

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


// mutations.js
import { gql } from '@apollo/client';

export const CREATE_CATEGORY = gql`
  mutation CreateCategory($input: CreateCategoryInput!) {
    createCategory(input: $input) {
      id
      name
      description
    }
  }
`;
