import * as React from "react";
import { Admin, Resource } from 'react-admin';

import authProvider from './authProvider';
import getDataProvider from './dataProvider';
import speakers from './speakers';
import places from './places';
import webSiteTypes from './webSiteTypes';
import tags from './tags';
import talkTypes from './talkTypes';
import editionCategories from './editionCategories';
import editionModes from './editionModes';

const App = () => (
    <Admin authProvider={authProvider} dataProvider={getDataProvider()}>
        <Resource name="speakers" {...speakers} />
        <Resource name="places" {...places} />
        <Resource name="web_site_types" {...webSiteTypes} />
        <Resource name="tags" {...tags} />
        <Resource name="talk_types" {...talkTypes} />
        <Resource name="edition_categories" {...editionCategories} />
        <Resource name="edition_modes" {...editionModes} />
    </Admin>
);

export default App;
