import React, { useState } from 'react';
import CartOverlay from './CartOverlay';

const Header = ({ cartItems }) => {
  const [showCartOverlay, setShowCartOverlay] = useState(false);

  const toggleCartOverlay = () => {
    setShowCartOverlay(!showCartOverlay);
  };

  return (
    <header>
      <nav>
        <ul>
          <li><a href="/men">Men</a></li>
          <li><a href="/women">Women</a></li>
          <li><a href="/kids">Kids</a></li>
        </ul>
        <div className="cart" onClick={toggleCartOverlay}>
          <span className="cart-icon">🛒</span>
          {cartItems.length > 0 && <span className="item-count">{cartItems.length}</span>}
        </div>
      </nav>
      {showCartOverlay && <CartOverlay cartItems={cartItems} />}
    </header>
  );
};

export default Header;