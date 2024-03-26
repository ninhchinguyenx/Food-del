import { useContext } from "react";
import { StoreContext } from "../../context/StoreContext";
import { useParams } from "react-router-dom";
import Breadcrums from "../../components/Breadcrums/Breadcrums";
import DetailFood from "../../components/DetailFood/DetailFood";
import DescriptionBox from "../../components/DescriptionBox/DescriptionBox";
import RelatedFoods from "../../components/RelatedFoods/RelatedFoods";

const Food = () => {
  const { food_list } = useContext(StoreContext);
  const { foodId } = useParams();

  const food = food_list.find((e) => e._id === foodId);

  return (
    <div>
      <Breadcrums food={food} />
      <DetailFood food={food} />
      <DescriptionBox />
      <RelatedFoods category={food.category} />
    </div>
  );
};

export default Food;
