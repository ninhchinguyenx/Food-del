import NavBar from "./components/NavBar/NavBar";
import { Route, Routes } from "react-router-dom";
import Home from "./pages/Home/Home";
import PlaceOrder from "./pages/PlaceOrder/PlaceOrder";
import Cart from "./pages/Cart/Cart";
import Footer from "./components/Footer/Footer";
import Food from "./pages/Food/Food";
const App = () => {
  return (
    <>
      <div className="app">
        <NavBar />
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/cart" element={<Cart />} />
          <Route path="/place-order" element={<PlaceOrder />} />
          <Route path="/food" element={<Food />}>
            <Route path=":foodId" element={<Food />} />
          </Route>
        </Routes>
      </div>
      <Footer />
    </>
  );
};

export default App;
