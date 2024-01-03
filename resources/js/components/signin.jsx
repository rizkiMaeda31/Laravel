import React from 'react';
// import ReactDOM from 'react-dom/client';
import { CardGroup, Carousel, Container, Image, Nav, NavDropdown, Navbar, Card } from 'react-bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

export const Signin=()=>{
    const navbar=<Navbar expand="lg" className="bg-body-tertiary" fixed="top">
                    <Container>
                      <Navbar.Brand href="/">React-Bootstrap</Navbar.Brand>
                      <Navbar.Toggle aria-controls="basic-navbar-nav" />
                      <Navbar.Collapse id="basic-navbar-nav">
                        <Nav className="me-auto">
                          <Nav.Link href="/">Home</Nav.Link>
                          <Nav.Link href="/signin">Sign-in</Nav.Link>
                          <NavDropdown title="Our Features" id="basic-nav-dropdown">
                            <NavDropdown.Item href="#about-section">About</NavDropdown.Item>
                            <NavDropdown.Item href="#action/3.2">
                              Pricing
                            </NavDropdown.Item>
                            <NavDropdown.Item href="#action/3.3">Contact Us</NavDropdown.Item>
                            <NavDropdown.Divider />
                            {/* <NavDropdown.Item href="#action/3.4">
                              Separated link
                            </NavDropdown.Item> */}
                          </NavDropdown>
                        </Nav>
                      </Navbar.Collapse>
                    </Container>
                  </Navbar>
    return(<>
        {navbar}
        <h1>Login</h1>
        </>)
}

// const root = ReactDOM.createRoot(document.getElementById("root"));
// root.render(
//   <React.StrictMode>
//     <Signin />
//   </React.StrictMode>
// );