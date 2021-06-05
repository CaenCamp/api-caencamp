import React from "react";
import PropTypes from "prop-types";
import OrganizationIcon from '@material-ui/icons/Domain';
import {
  Datagrid,
  Create,
  Edit,
  EditButton,
  Filter,
  List,
  Pagination,
  SimpleForm,
  TextField,
  TextInput,
  required,
  TabbedForm,
  FormTab,
} from "react-admin";

const OrganizationFilters = (props) => (
  <Filter {...props}>
    <TextInput source="name" alwaysOn />
  </Filter>
);

const WebsiteField = ({ record = {} }) => {
  if (!record.url) return <span>Pas de site renseigné.</span>;

  return (
    <a href={record.url} target="_blank" rel="noreferrer">
      Site web
    </a>
  );
};

WebsiteField.propTypes = {
  label: PropTypes.string,
  record: PropTypes.object,
};

const OrganizationPagination = (props) => (
  <Pagination rowsPerPageOptions={[10, 25]} {...props} />
);

const OrganizationList = (props) => {
  return (
    <List
      {...props}
      filters={<OrganizationFilters />}
      filterDefaultValues={{}}
      sort={{ field: "name", order: "ASC" }}
      exporter={false}
      pagination={<OrganizationPagination />}
      bulkActionButtons={false}
    >
      <Datagrid>
        <TextField source="name" sortable={true} />
        <WebsiteField source="url" sortable={false} />
        <EditButton />
      </Datagrid>
    </List>
  );
};

const OrganizationTitle = ({ record }) => (record ? `Organization "${record.name}"` : null);

export const OrganizationEdit = (props) => (
  <Edit title={<OrganizationTitle />} {...props}>
    <TabbedForm>
      <FormTab label="Content">
        <TextInput fullWidth source="name" validate={required()} />
        <TextInput
          fullWidth
          source="description"
          multiline
          validate={required()}
        />
        <TextInput fullWidth source="url" label="Web site" />
      </FormTab>
    </TabbedForm>
  </Edit>
);

export const OrganizationCreate = (props) => (
  <Create {...props}>
    <SimpleForm initialValues={{ country: 'FR' }}>
      <TextInput fullWidth source="name" validate={required()} />
      <TextInput
          fullWidth
          source="description"
          multiline
          validate={required()}
        />
      <TextInput fullWidth source="url" label="Web site" />
    </SimpleForm>
  </Create>
);

const organizations = {
  icon: OrganizationIcon,
  list: OrganizationList,
  edit: OrganizationEdit,
  create: OrganizationCreate,
};

export default organizations;
