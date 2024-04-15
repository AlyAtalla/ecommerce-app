import React, { useState } from 'react';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';
import CartOverlay from './components/CartOverlay';
import CategoryPage from './components/CategoryPage';
import Header from './components/Header';

const App = () => {
 const [cartItems, setCartItems] = useState([]);

 const addToCart = (product) => {
    const existingItemIndex = cartItems.findIndex(item => item.id === product.id);
    if (existingItemIndex !== -1) {
      const updatedCartItems = [...cartItems];
      updatedCartItems[existingItemIndex].quantity += 1;
      setCartItems(updatedCartItems);
    } else {
      setCartItems(prevCartItems => [...prevCartItems, { ...product, quantity: 1 }]);
    }
 };

 const removeFromCart = (productId) => {
    const updatedCartItems = cartItems.filter(item => item.id !== productId);
    setCartItems(updatedCartItems);
 };

 const placeOrder = () => {
    if (cartItems.length === 0) {
      console.log("Your cart is empty.");
      return;
    }
    const totalPrice = cartItems.reduce((total, item) => total + (item.price * item.quantity), 0);
    console.log("Order placed:", cartItems, "Total Price:", totalPrice);
    setCartItems([]);
 };

 return (
    <Router>
      <div className="App">
        <Header />
        <Switch>
          <Route exact path="/" render={() => <CategoryPage category="Men" addToCart={addToCart} />} />
          <Route exact path="/women" render={() => <CategoryPage category="Women" addToCart={addToCart} />} />
          <Route exact path="/kids" render={() => <CategoryPage category="Kids" addToCart={addToCart} />} />
        </Switch>
        <CartOverlay cartItems={cartItems} removeFromCart={removeFromCart} placeOrder={placeOrder} />
      </div>
    </Router>
 );
};

export default App;
