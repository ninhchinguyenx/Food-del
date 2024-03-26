import React, { useContext } from "react";
import "./CartItem.css";
import { StoreContext } from "../../context/StoreContext";
import { assets } from "../../assets/assets";
const CartItem = () => {
  const { food_list, cartItems, removeFromCart, getTotalCartAmount } =
    useContext(StoreContext);
  console.log(cartItems);
  return (
    <div className="cartItems">
      <div className="cartItem-format-main">
        <p>Foods</p>
        <p>Name</p>
        <p>Price</p>
        <p>Quanlity</p>
        <p>Total</p>
        <p>Remove</p>
      </div>
      <hr />
      {food_list.map((e) => {
        if (cartItems[e._id] > 0) {
          return (
            <div>
              <div className="cartItems-format cartItem-format-main ">
                <img src={e.image} alt="" className="carticon-food-icon" />
                <p>{e.name}</p>
                <p>${e.price}</p>
                <button className="fooditems-quanlity">
                  {cartItems[e._id]}
                </button>
                <p>${e.price * cartItems[e._id]}</p>
                <img
                  className="food-remove-icon"
                  src={assets.cross_icon}
                  onClick={() => {
                    removeFromCart(e._id);
                  }}
                  alt=""
                />
              </div>
              <hr />
            </div>
          );
        }
        return null;
      })}
      <div className="fooditems-down">
        <div className="foodItem-total">
          <div>
            <h1>Cart Total</h1>
            <div>
              <div className="foodItem-total-item">
                <p>Subtotal</p>
                <p>${getTotalCartAmount()}</p>
              </div>
              <hr />
              <div className="foodItem-total-item">
                <p>Shipping Free</p>
                <p>Free</p>
              </div>
              <hr />
              <div className="foodItem-total-item">
                <h3>Total</h3>
                <h3>${getTotalCartAmount()}</h3>
              </div>
            </div>
            <button>PROCEED TO CHECKOUT</button>
          </div>
          <div className="fooditems-promocode">
            <p>If you have a promo code, Enter it here</p>
            <div className="fooditems-promobox">
              <input type="text" placeholder="Enter promo" />
              <button>Submit</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default CartItem;
