import React from 'react';

const CartOverlay = ({ cartItems, closeCart }) => {
  const calculateTotal = (cartItems) => {
    return cartItems.reduce((total, item) => total + (item.price * item.quantity), 0);
  };

  return (
    <div className="cart-overlay">
      <div className="cart-content">
        <span className="close-btn" onClick={closeCart}>×</span>
        <h2>Cart</h2>
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
                    <p>${item.price}</p>
                    <button>+</button>
                    <span>{item.quantity}</span>
                    <button>-</button>
                  </div>
                </div>
              ))}
            </div>
            <div className="cart-total">
              <p>Total: ${calculateTotal(cartItems)}</p>
              <button>Place Order</button>
            </div>
          </React.Fragment>
        )}
      </div>
    </div>
  );
};

export default CartOverlay;
