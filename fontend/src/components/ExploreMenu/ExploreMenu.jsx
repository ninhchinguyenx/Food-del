import "./ExploreMenu.css";
import { menu_list } from "../../assets/assets";
const ExploreMenu = (props) => {
  const { setCategory, category } = props;

  return (
    <div className="explore-menu" id="explore-menu">
      <h1>Explore our menu</h1>
      <p className="explore-menu-text">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores facilis
        consectetur nesciunt totam ipsam? Temporibus maiores quam minima
        sapiente possimus.
      </p>
      <div className="explore-menu-list">
        {menu_list.map((menu, index) => {
          return (
            <div
              onClick={() =>
                setCategory((prev) =>
                  prev === menu.menu_name ? "All" : menu.menu_name
                )
              }
              className="explore-menu-list-item"
              key={index}
            >
              <img
                className={category === menu.menu_name ? "active" : ""}
                src={menu.menu_image}
                alt=""
              />
              <h3>{menu.menu_name}</h3>
            </div>
          );
        })}
      </div>
      <hr />
    </div>
  );
};

export default ExploreMenu;
