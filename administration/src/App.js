import * as React from "react";
import { Admin, Resource, ListGuesser } from 'react-admin';
import getDataProvider from './dataProvider';

const App = () => (
    <Admin dataProvider={getDataProvider()}>
        <Resource name="speakers" list={ListGuesser} />
    </Admin>
);

export default App;
