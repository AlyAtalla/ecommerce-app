import React from 'react';

const CartOverlay = ({ cartItems, removeFromCart, placeOrder }) => {
 const handleRemoveFromCart = (productId) => {
    removeFromCart(productId);
 };

 const handlePlaceOrder = () => {
    placeOrder();
 };

 return (
    <div className="cart-overlay">
      {cartItems.length === 0 ? (
        <p>Your cart is empty</p>
      ) : (
        <React.Fragment>
          <div className="cart-items">
            {cartItems.map((item) => (
              <div key={item.id} className="cart-item">
                <img src={item.image} alt={item.name} />
                <div className="item-details">
                 <p>{item.name}</p>
                 <p>Quantity: {item.quantity}</p>
                 <button onClick={() => handleRemoveFromCart(item.id)}>Remove</button>
                </div>
              </div>
            ))}
          </div>
          <div className="cart-summary">
            <p>Total Items: {cartItems.length}</p>
            <button onClick={handlePlaceOrder} disabled={cartItems.length === 0}>Place Order</button>
          </div>
        </React.Fragment>
      )}
    </div>
 );
};

export default CartOverlay;
