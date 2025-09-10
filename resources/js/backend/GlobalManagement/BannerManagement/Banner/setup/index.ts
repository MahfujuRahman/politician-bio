
import app_config from "@config/app_config";
import setup_type from "./setup_type";

const prefix: string = "Banner";

const setup: setup_type = {
    prefix,
    permission: ["admin", "super_admin"],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: "banners",

    module_name: "banner",
    store_prefix: "banner",
    route_prefix: "Banner",
    route_path: "banner",

    select_fields: [
        "id",
        "slogan",
            "election_type",
            "main_title",
            "short_title",
            "description",
            "perma_link",
            "image",
            "background_image",
        "status",
        "slug",
        "created_at",
        'deleted_at'
    ],

    sort_by_cols: [
        "id",
        "slogan",
            "election_type",
            "main_title",
            "short_title",
            "description",
            "perma_link",
            "image",
            "background_image",
        "status",
        "created_at",
    ],
    table_header_data: [
        "id",
        "slogan",
            "election_type",
            "main_title",
            "short_title",
            "description",
            "perma_link",
            "image",
            "background_image",
        "status",
        "created_at",
    ],
    table_row_data: [
        "id",
        "slogan",
            "election_type",
            "main_title",
            "short_title",
            "description",
            "perma_link",
            "image",
            "background_image",
        "status",
        "created_at",
    ],
    quick_view_data: [
        "id",
        "slogan",
            "election_type",
            "main_title",
            "short_title",
            "description",
            "perma_link",
            "image",
            "background_image",
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
