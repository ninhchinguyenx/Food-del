import "./Breadcrums.css";
const Breadcrums = (props) => {
  const { food } = props;

  return (
    <div className="breadcrum">
      HOME {">"} SHOP {">"} {food.category} {">"} {food.name}
    </div>
  );
};

export default Breadcrums;
