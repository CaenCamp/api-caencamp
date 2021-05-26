import * as React from "react";
import { Admin, Resource } from 'react-admin';

import authProvider from './authProvider';
import getDataProvider from './dataProvider';
import speakers from './speakers';

const App = () => (
    <Admin authProvider={authProvider} dataProvider={getDataProvider()}>
        <Resource name="speakers" {...speakers} />
    </Admin>
);

export default App;
