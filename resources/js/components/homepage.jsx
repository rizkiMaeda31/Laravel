import { CardGroup, Carousel, Container, Image, Nav, NavDropdown, Navbar, Card } from 'react-bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import React from 'react';
import ReactDOM from 'react-dom/client';

export const LandPage=()=>{
    const navbar=<Navbar expand="lg" className="bg-body-tertiary" fixed="top">
                    <Container>
                      <Navbar.Brand href="/">React-Bootstrap</Navbar.Brand>
                      <Navbar.Toggle aria-controls="basic-navbar-nav" />
                      <Navbar.Collapse id="basic-navbar-nav">
                        <Nav className="me-auto">
                          <Nav.Link href="/">Home</Nav.Link>
                          <Nav.Link href="/sign-in">Sign-in</Nav.Link>
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
    const carousel=<Carousel>
                      <Carousel.Item interval={1000}>
                      <Image src="https://picsum.photos/1200/300?random=100"  fluid className="mx-auto d-block img-fluid"/>
                        <Carousel.Caption>
                          <h3>First slide label</h3>
                          <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                        </Carousel.Caption>
                      </Carousel.Item>
                      <Carousel.Item interval={500}>
                      <Image src="https://picsum.photos/800/300?random=10"  fluid className="mx-auto d-block img-fluid" />
                        <Carousel.Caption>
                          <h3>Second slide label</h3>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </Carousel.Caption>
                      </Carousel.Item>
                      <Carousel.Item>
                      <Image src="https://picsum.photos/800/300?random=5"  fluid className="mx-auto d-block img-fluid" />
                        <Carousel.Caption>
                          <h3>Third slide label</h3>
                          <p>
                            Praesent commodo cursus magna, vel scelerisque nisl consectetur.
                          </p>
                        </Carousel.Caption>
                      </Carousel.Item>
                    </Carousel>
    const about=<><div className="about-section" id='about-section'>
    <h1>About Us Page</h1>
    <p>Some text about who we are and what we do.</p>
    <p>Resize the browser window to see that this page is responsive by the way.</p>
  </div></>
    const CG=<CardGroup>
    <Card>
      <Card.Img variant="top" src="https://picsum.photos/1200/300?random=48"  className="mx-auto d-block img-fluid" />
      <Card.Body>
        <Card.Title>Card title</Card.Title>
        <Card.Text>
          This is a wider card with supporting text below as a natural lead-in
          to additional content. This content is a little bit longer.
        </Card.Text>
      </Card.Body>
      <Card.Footer>
        <small className="text-muted">Last updated 3 mins ago</small>
      </Card.Footer>
    </Card>
    <Card>
      <Card.Img variant="top" src="https://picsum.photos/1200/300?random=36"  className="mx-auto d-block img-fluid" />
      <Card.Body>
        <Card.Title>Card title</Card.Title>
        <Card.Text>
          This card has supporting text below as a natural lead-in to
          additional content.{' '}
        </Card.Text>
      </Card.Body>
      <Card.Footer>
        <small className="text-muted">Last updated 3 mins ago</small>
      </Card.Footer>
    </Card>
    <Card>
      <Card.Img variant="top" src="https://picsum.photos/1200/300?random=100"  className="mx-auto d-block img-fluid" />
      <Card.Body>
        <Card.Title>Card title</Card.Title>
        <Card.Text>
          This is a wider card with supporting text below as a natural lead-in
          to additional content. This card has even longer content than the
          first to show that equal height action.
        </Card.Text>
      </Card.Body>
      <Card.Footer>
        <small className="text-muted">Last updated 3 mins ago</small>
      </Card.Footer>
    </Card>
  </CardGroup>

    const pricing=''
    const contactus=''
    return(<>
        {navbar}
        
        {carousel}
        {about}
        {CG}
        </>)
}


// const root = ReactDOM.createRoot(document.getElementById("root"));
// root.render(
//   <React.StrictMode>
//     <LandPage />
//   </React.StrictMode>
// );