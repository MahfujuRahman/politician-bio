
import app_config from "@config/app_config";
import setup_type from "./setup_type";

const prefix: string = "ContactAddress";

const setup: setup_type = {
    prefix,
    permission: ["admin", "super_admin"],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: "contact-addresses",

    module_name: "contact-address",
    store_prefix: "contact_address",
    route_prefix: "ContactAddress",
    route_path: "contact-address",

    select_fields: [
        "id",
        "icon",
            "name",
            "address",
            "phone_number",
            "email",
            "map_link",
        "status",
        "slug",
        "created_at",
        'deleted_at'
    ],

    sort_by_cols: [
        "id",
        "icon",
            "name",
            "address",
            "phone_number",
            "email",
            "map_link",
        "status",
        "created_at",
    ],
    table_header_data: [
        "id",
        "icon",
            "name",
            "address",
            "phone_number",
            "email",
            "map_link",
        "status",
        "created_at",
    ],
    table_row_data: [
        "id",
        "icon",
            "name",
            "address",
            "phone_number",
            "email",
            "map_link",
        "status",
        "created_at",
    ],
    quick_view_data: [
        "id",
        "icon",
            "name",
            "address",
            "phone_number",
            "email",
            "map_link",
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
