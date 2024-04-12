import React from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import { Playground, store } from 'graphql-playground-react';

import App from './App';

const rootElement = document.getElementById('root');
ReactDOM.render(
 <React.StrictMode>
    <Provider store={store}>
      <Playground endpoint='http://localhost:8000/'/>
      <App />
    </Provider>
 </React.StrictMode>,
 rootElement
);
