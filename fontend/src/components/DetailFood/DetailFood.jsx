import "./DetailFood.css";
import { assets } from "../../assets/assets";
import { useContext } from "react";
import { StoreContext } from "../../context/StoreContext";
const DetailFood = (props) => {
  const { food } = props;
  const { addToCart } = useContext(StoreContext);

  return (
    <div className="foodDisplay">
      <div className="foodDisplay-left">
        <div className="foodDisplay-img-list">
          <img src={food.image} alt="" />
          <img src={food.image} alt="" />
          <img src={food.image} alt="" />
          <img src={food.image} alt="" />
        </div>
        <div className="foodDisplay-img">
          <img src={food.image} alt="" className="foodDisplay-main-img" />
        </div>
      </div>
      <div className="foodDisplay-right">
        <h1>{food.name}</h1>
        <div className="foodDisplay-right-start">
          <img src={assets.rating_starts} alt="" />
          <p>(1)</p>
        </div>
        <div className="foodDisplay-right-price">${food.price}</div>
        <div className="foodDisplay-right-desc">{food.description}</div>
        <button
          onClick={() => {
            addToCart(food._id);
          }}
        >
          ADD To Cart
        </button>
        <p className="foodDisplay-right-category">
          <span>Category: {food.category}</span>
        </p>
      </div>
    </div>
  );
};

export default DetailFood;
