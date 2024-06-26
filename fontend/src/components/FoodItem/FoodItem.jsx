// import { useContext } from "react";
import { assets } from "../../assets/assets";
import "./FoodItem.css";
import { Link } from "react-router-dom";
// import { StoreContext } from "../../context/StoreContext";
const FoodItem = (props) => {
  const { id, name, desc, price, img } = props;

  // const { cartItems, addToCart, removeFromCart } = useContext(StoreContext);
  return (
    <div className="food-item">
      <div className="food-item-img-container">
        <Link to={`/food/${id}`}>
          {" "}
          <img
            src={img}
            className="food-item-image"
            alt=""
            onClick={window.scrollTo(0, 0)}
          />
        </Link>
        {/* {!cartItems[id] ? (
          <img
            className="add"
            onClick={() => addToCart(id)}
            src={assets.add_icon_white}
            alt=""
          />
        ) : (
          <div className="food-item-counter">
            <img
              onClick={() => removeFromCart(id)}
              src={assets.remove_icon_red}
              alt=""
            />
            <p>{cartItems[id]}</p>
            <img
              onClick={() => addToCart(id)}
              src={assets.add_icon_green}
              alt=""
            />
          </div>
        )} */}
      </div>
      <div className="food-item-info">
        <div className="food-item-name-rating">
          <p>{name}</p>
          <img src={assets.rating_starts} alt="" />
        </div>
        <p className="food-item-desc">{desc}</p>
        <p className="food-item-price">${price}</p>
      </div>
    </div>
  );
};

export default FoodItem;
