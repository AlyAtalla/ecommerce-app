const express = require('express');
const { graphqlHTTP } = require('express-graphql');
const { buildSchema } = require('graphql');

// Mock data (replace with actual data retrieval logic)
const data = require('./data.json');
const categories = data.categories;

// Define your GraphQL schema
const schema = buildSchema(`
  type Category {
    id: ID!
    name: String!
    description: String
  }

  type Query {
    getCategory(id: ID!): Category
    getAllCategories: [Category]
  }

  input CreateCategoryInput {
    name: String!
    description: String
  }

  input UpdateCategoryInput {
    id: ID!
    name: String!
    description: String
  }

  type Mutation {
    createCategory(input: CreateCategoryInput!): Category
    updateCategory(input: UpdateCategoryInput!): Category
    deleteCategory(id: ID!): Boolean
  }
`);

// Define your resolvers
const root = {
  getCategory: ({ id }) => {
    return categories.find(category => category.id === id);
  },
  getAllCategories: () => {
    return categories;
  },
  createCategory: ({ input }) => {
    const newCategory = {
      id: String(categories.length + 1),
      name: input.name,
      description: input.description || null,
    };
    categories.push(newCategory);
    return newCategory;
  },
  updateCategory: ({ input }) => {
    const categoryIndex = categories.findIndex(category => category.id === input.id);
    if (categoryIndex === -1) {
      throw new Error('Category not found');
    }
    categories[categoryIndex] = {
      id: input.id,
      name: input.name,
      description: input.description || null,
    };
    return categories[categoryIndex];
  },
  deleteCategory: ({ id }) => {
    const categoryIndex = categories.findIndex(category => category.id === id);
    if (categoryIndex === -1) {
      throw new Error('Category not found');
    }
    categories.splice(categoryIndex, 1);
    return true;
  },
};

// Create an Express server
const app = express();

// Route handler for GET requests to the root path ("/")
app.get('/', (req, res) => {
  res.send('Hello, World!'); // Or any other response you want to send
});

// Route handler for POST requests to the root path ("/")
app.post('/', (req, res) => {
  // Your logic for handling POST requests to the root path ("/") goes here
  res.send('Handling POST request to the root path ("/")');
});

// Set up the /graphql route to handle GraphQL requests
app.use('/graphql', graphqlHTTP({
  schema: schema,
  rootValue: root,
  graphiql: true, // Enable the GraphiQL interface for testing
}));

// Start the server
const PORT = process.env.PORT || 8000;
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
