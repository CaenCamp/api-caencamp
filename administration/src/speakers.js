import React from "react";
import PropTypes from "prop-types";
import FaceIcon from "@material-ui/icons/Face";
import {
  Datagrid,
  Create,
  Edit,
  EditButton,
  Filter,
  List,
  Pagination,
  SimpleForm,
  SelectInput,
  SelectArrayInput,
  TextField,
  TextInput,
  maxLength,
  required,
  ReferenceArrayInput,
  TabbedForm,
  FormTab,
} from "react-admin";

const SpeakerFilters = (props) => (
  <Filter {...props}>
    <TextInput source="name" alwaysOn />
  </Filter>
);

const WebsitesField = ({ record = {} }) => (
  <span>{record.websites.length}</span>
);

WebsitesField.propTypes = {
  label: PropTypes.string,
  record: PropTypes.object,
};

const TalksField = ({ record = {} }) => <span>{record.talks.length}</span>;

TalksField.propTypes = {
  label: PropTypes.string,
  record: PropTypes.object,
};

const SpeakerPagination = (props) => (
  <Pagination rowsPerPageOptions={[10, 25]} {...props} />
);

const SpeakerList = (props) => {
  return (
    <List
      {...props}
      filters={<SpeakerFilters />}
      filterDefaultValues={{}}
      sort={{ field: "id", order: "DESC" }}
      exporter={false}
      pagination={<SpeakerPagination />}
      bulkActionButtons={false}
    >
      <Datagrid>
        <TextField source="name" sortable={true} />
        <TextField source="shortbiography" sortable={false} />
        <WebsitesField source="websites" sortable={false} />
        <TalksField source="talks" sortable={false} />
        <EditButton />
      </Datagrid>
    </List>
  );
};

const SpeakerTitle = ({ record }) =>
  record ? `Speaker "${record.name}"` : null;

export const SpeakerEdit = (props) => (
  <Edit title={<SpeakerTitle />} {...props}>
    <TabbedForm>
      <FormTab label="Content">
        <TextInput fullWidth source="name" validate={required()} />
        <TextInput
          fullWidth
          source="shortbiography"
          label="Bio rapide"
          validate={required()}
        />
        <TextInput
          fullWidth
          source="biography"
          label="Bio complète"
          multiline
          validate={required()}
        />
      </FormTab>
      <FormTab label="Sites web">
        <p>Liste des sites avec crud</p>
      </FormTab>
      <FormTab label="Les talks">
        <p>Simple liste des talks avec lien d'édition</p>
      </FormTab>
    </TabbedForm>
  </Edit>
);

export const SpeakerCreate = (props) => (
  <Create {...props}>
    <SimpleForm>
      <TextInput fullWidth source="name" validate={required()} />
      <TextInput
        fullWidth
        source="shortbiography"
        label="Bio rapide"
        validate={required()}
      />
      <TextInput
        fullWidth
        source="biography"
        label="Bio complète"
        multiline
        validate={required()}
      />
    </SimpleForm>
  </Create>
);

const speakers = {
  icon: FaceIcon,
  list: SpeakerList,
  edit: SpeakerEdit,
  create: SpeakerCreate,
};

export default speakers;
