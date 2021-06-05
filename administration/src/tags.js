import React from "react";
import TagIcon from '@material-ui/icons/Loyalty';
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
} from "react-admin";
import PropTypes from "prop-types";

const TalksField = ({ record = {} }) => <span>{record.talks.length}</span>;

TalksField.propTypes = {
  label: PropTypes.string,
  record: PropTypes.object,
};

const TagPagination = (props) => (
  <Pagination rowsPerPageOptions={[10, 25]} {...props} />
);

const TagFilters = (props) => (
    <Filter {...props}>
      <TextInput source="label" alwaysOn />
    </Filter>
  );

const TagList = (props) => {
  return (
    <List
      {...props}
      filters={<TagFilters />}
      filterDefaultValues={{}}
      sort={{ field: "label", order: "ASC" }}
      exporter={false}
      pagination={<TagPagination />}
      bulkActionButtons={false}
    >
      <Datagrid>
        <TextField source="label" sortable={true} />
        <TalksField source="talks" sortable={false} />
        <EditButton />
      </Datagrid>
    </List>
  );
};

const TagTitle = ({ record }) => (record ? `Tag "${record.name}"` : null);

export const TagEdit = (props) => (
  <Edit title={<TagTitle />} {...props}>
    <SimpleForm>
        <TextInput fullWidth source="label" validate={required()} />
    </SimpleForm>
  </Edit>
);

export const TagCreate = (props) => (
  <Create {...props}>
    <SimpleForm>
        <TextInput fullWidth source="label" validate={required()} />
    </SimpleForm>
  </Create>
);

const tags = {
  icon: TagIcon,
  list: TagList,
  edit: TagEdit,
  create: TagCreate,
};

export default tags;
