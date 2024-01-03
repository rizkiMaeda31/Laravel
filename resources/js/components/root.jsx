import React from 'react';
import ReactDOM from 'react-dom/client';
import { BrowserRouter, Route, Routes, useRoutes } from 'react-router-dom';
import {Signin} from './signin';
import { Register } from './register';
import { Dashboard } from './dashboard';
// import { ProtectedRoute } from '../custom hooks/authentication';
import { LandPage } from './homepage';
import { ProtectedRoute } from '../custom hooks/authentication';
// import { ProtectedRoute } from '../custom hooks/ProtectedRoute';



export default function App() {
  const routes = useRoutes([
    {
      path:"/" , element:<LandPage /> 
    },
    {
      path:"/sign-in", element:<Signin /> 
    },
    {
      path:"/register", element:<Register /> 
    },
    {
      path:"/dashboard", element:<ProtectedRoute><Dashboard /></ProtectedRoute>
    },
  ]);
  return routes;
}

const root = ReactDOM.createRoot(document.getElementById("root"));
root.render(
  <React.StrictMode>
    <BrowserRouter>
      <App />
    </BrowserRouter>
  </React.StrictMode>
);


