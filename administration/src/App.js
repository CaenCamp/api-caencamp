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
        <Resource name="speakers" {...speakers} options={{ label: 'Les speakers' }}/>
        <Resource name="places" {...places}  options={{ label: 'Les lieux' }}/>
        <Resource name="tags" {...tags}  options={{ label: 'Les tags' }}/>
        <Resource name="talk_types" {...talkTypes}  options={{ label: 'Les types de talks' }}/>
        <Resource name="edition_categories" {...editionCategories} options={{ label: 'Les catégories d\'éditions' }}/>
        <Resource name="edition_modes" {...editionModes} options={{ label: 'Les modes d\'éditions' }}/>
        <Resource name="web_site_types" {...webSiteTypes}  options={{ label: 'Les types de site' }}/>
    </Admin>
);

export default App;
