
import app_config from "@config/app_config";
import setup_type from "./setup_type";

const prefix: string = "Volunteer";

const setup: setup_type = {
    prefix,
    permission: ["admin", "super_admin"],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: "volunteers",

    module_name: "volunteer",
    store_prefix: "volunteer",
    route_prefix: "Volunteer",
    route_path: "volunteer",

    select_fields: [
        "id",
        "name",
            "designation",
            "social_link",
            "image",
        "status",
        "slug",
        "created_at",
        'deleted_at'
    ],

    sort_by_cols: [
        "id",
        "name",
            "designation",
            "social_link",
            "image",
        "status",
        "created_at",
    ],
    table_header_data: [
        "id",
        "name",
            "designation",
            
            "image",
        "status",
        "created_at",
    ],
    table_row_data: [
        "id",
        "name",
            "designation",
            
            "image",
        "status",
        "created_at",
    ],
    quick_view_data: [
        "id",
        "name",
            "designation",
            "social_link",
            "image",
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
