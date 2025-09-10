
import app_config from "@config/app_config";
import setup_type from "./setup_type";

const prefix: string = "GetInvolved";

const setup: setup_type = {
    prefix,
    permission: ["admin", "super_admin"],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: "get-involveds",

    module_name: "get-involved",
    store_prefix: "get_involved",
    route_prefix: "GetInvolved",
    route_path: "get-involved",

    select_fields: [
        "id",
        "first_name",
            "last_name",
            "email",
            "phone_number",
            "help_types",
            "preferred_times",
            "preferred_days",
            "comments",
        "status",
        "slug",
        "created_at",
        'deleted_at'
    ],

    sort_by_cols: [
        "id",
        "first_name",
            "last_name",
            "email",
            "phone_number",
            "help_types",
            "preferred_times",
            "preferred_days",
            "comments",
        "status",
        "created_at",
    ],
    table_header_data: [
        "id",
        "first_name",
            "last_name",
            "email",
            "phone_number",
            "help_types",
            "preferred_times",
            "preferred_days",
            "comments",
        "status",
        "created_at",
    ],
    table_row_data: [
        "id",
        "first_name",
            "last_name",
            "email",
            "phone_number",
            "help_types",
            "preferred_times",
            "preferred_days",
            "comments",
        "status",
        "created_at",
    ],
    quick_view_data: [
        "id",
        "first_name",
            "last_name",
            "email",
            "phone_number",
            "help_types",
            "preferred_times",
            "preferred_days",
            "comments",
        "status",
        "created_at",
    ],

    layout_title: prefix + " Management",
    page_title: `${prefix} Management`,

    all_page_title: "All " + prefix,
    details_page_title: "Details " + prefix,
    create_page_title: "Create " + prefix,
    edit_page_title: "Edit " + prefix,
};

export default setup;
