import * as React from "react";
import { Admin, Resource } from 'react-admin';

import authProvider from './authProvider';
import getDataProvider from './dataProvider';
import speakers from './speakers';
import places from './places';

const App = () => (
    <Admin authProvider={authProvider} dataProvider={getDataProvider()}>
        <Resource name="speakers" {...speakers} />
        <Resource name="places" {...places} />
    </Admin>
);

export default App;
