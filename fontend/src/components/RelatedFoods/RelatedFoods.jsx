import { useContext } from "react";
import "./RelatedFoods.css";

import { StoreContext } from "../../context/StoreContext";
import FoodItem from "../../components/FoodItem/FoodItem";
const RelatedFoods = ({ category }) => {
  const { food_list } = useContext(StoreContext);
  return (
    <div className="relatedFood">
      <h1>Related Foods</h1>
      <hr />
      <div className="relatedFoods-item">
        {food_list.map((item, index) => {
          if (category === item.category) {
            return (
              <FoodItem
                key={index}
                id={item._id}
                name={item.name}
                price={item.price}
                desc={item.description}
                img={item.image}
              />
            );
          }
        })}
      </div>
    </div>
  );
};

export default RelatedFoods;
