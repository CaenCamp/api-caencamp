import React from 'react';
import PropTypes from 'prop-types';
import FaceIcon from '@material-ui/icons/Face';
import {
    Datagrid,
    DateField,
    DateTimeInput,
    DeleteButton,
    Edit,
    EditButton,
    Filter,
    List,
    Pagination,
    SelectInput,
    SelectArrayInput,
    TextField,
    TextInput,
    maxLength,
    required,
    ReferenceArrayInput,
    TabbedForm,
    FormTab,
} from 'react-admin';

const SpeakerFilters = (props) => (
    <Filter {...props}>
        <TextInput source="name" alwaysOn />
    </Filter>
);

const WebsitesField = ({ record = {} }) => (
    <span>
        {record.WebSites.length}
    </span>
);

WebsitesField.propTypes = {
    label: PropTypes.string,
    record: PropTypes.object,
};

const TalksField = ({ record = {} }) => (
    <span>
        {record.talks.length}
    </span>
);

TalksField.propTypes = {
    label: PropTypes.string,
    record: PropTypes.object,
};

const SpeakerPagination = (props) => <Pagination rowsPerPageOptions={[10, 25]} {...props} />;

const SpeakerList = (props) => {
    return (
        <List
            {...props}
            filters={<SpeakerFilters />}
            filterDefaultValues={{}}
            sort={{ field: 'id', order: 'DESC' }}
            exporter={false}
            pagination={<SpeakerPagination />}
            bulkActionButtons={false}
        >
            <Datagrid>
                <TextField source="name" sortable={true} />
                <TextField source="short_biography" sortable={false} />
                <WebsitesField source="WebSites" sortable={false} />
                <TalksField source="talks" sortable={false} />
            </Datagrid>
        </List>
    );
};

// const TeaserTitle = ({ record }) => (record ? `Teaser ${record.title} - ${record.subtitle}` : null);

// export const TeaserEdit = (props) => (
//     <Edit title={<TeaserTitle />} {...props}>
//         <TabbedForm>
//             <FormTab label="Content">
//                 <TextInput fullWidth disabled source="programId" />
//                 <TextInput fullWidth disabled source="editorId" />
//                 <TextInput fullWidth disabled source="editorName" />
//                 <ReferenceArrayInput label="ACL" source="acl" reference="acl">
//                     <SelectArrayInput optionText="id" />
//                 </ReferenceArrayInput>
//                 <SelectInput fullWidth source="locale" choices={teaserLocales} validate={required()} />
//                 <SelectArrayInput fullWidth source="supports" choices={teaserSupports} validate={required()} />
//                 <SelectInput
//                     fullWidth
//                     source="geoblocking"
//                     choices={[
//                         { id: 'ALL', name: 'ALL' },
//                         { id: 'DE_FR', name: 'DE_FR' },
//                         { id: 'EUR_DE_FR', name: 'EUR_DE_FR' },
//                         { id: 'SAT', name: 'SAT' },
//                     ]}
//                 />
//                 <TextInput fullWidth source="title" validate={[required(), maxLength(400)]} />
//                 <TextInput fullWidth source="subtitle" validate={maxLength(400)} />
//                 <TextInput fullWidth source="shortDescription" />
//                 <TextInput fullWidth source="teaserText" validate={maxLength(220)} />
//                 <TextInput fullWidth source="callToAction" validate={maxLength(100)} />
//                 <TextInput fullWidth source="url" validate={maxLength(300)} />
//                 <TextInput fullWidth source="deepLink" validate={maxLength(150)} />
//                 <TextInput fullWidth source="duration" label="Duration in seconds" validate={required()} />
//                 <TextField fullWidth source="imageTimestamp" readOnly />
//                 <DateTimeInput fullWidth source="publicationBegin" />
//                 <DateTimeInput fullWidth source="publicationEnd" />
//             </FormTab>
//             <FormTab label="Raw images">
//                 <TeaserRawImage label="Landscape Image" source="images.landscape" />
//                 <TeaserRawImage label="Landscape Image With Text" source="images.landscape_with_text" />
//                 <TeaserRawImage label="Square Image" source="images.square" />
//                 <TeaserRawImage label="Square Image With Text" source="images.square_with_text" />
//                 <TeaserRawImage label="Portrait Image" source="images.portrait" />
//                 <TeaserRawImage label="Portrait Image With Text" source="images.portrait_with_text" />
//                 <TeaserRawImage label="Banner Image" source="images.banner" />
//                 <TeaserRawImage label="Banner Image With Text" source="images.banner_with_text" />
//             </FormTab>
//             <FormTab label="Preview images (with MAMI)">
//                 <TeaserMamiImage label="Landscape Image" format={FORMAT_LANDSCAPE} />
//                 <TeaserMamiImage label="Landscape Image With Text" format={FORMAT_LANDSCAPE_WITH_TEXT} />
//                 <TeaserMamiImage label="Square Image" format={FORMAT_SQUARE} />
//                 <TeaserMamiImage label="Square Image With Text" format={FORMAT_SQUARE_WITH_TEXT} />
//                 <TeaserMamiImage label="Portrait Image" format={FORMAT_PORTRAIT} />
//                 <TeaserMamiImage label="Portrait Image With Text" format={FORMAT_PORTRAIT_WITH_TEXT} />
//                 <TeaserMamiImage label="Banner Image" format={FORMAT_BANNER} />
//                 <TeaserMamiImage label="Banner Image With Text" format={FORMAT_BANNER_WITH_TEXT} />
//             </FormTab>
//         </TabbedForm>
//     </Edit>
// );

const speakers = {
    icon: FaceIcon,
    list: SpeakerList,
};

export default speakers;