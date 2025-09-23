
import app_config from "@config/app_config";
import setup_type from "./setup_type";

const prefix: string = "Donation";

const setup: setup_type = {
    prefix,
    permission: ["admin", "super_admin"],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: "donations",

    module_name: "donation",
    store_prefix: "donation",
    route_prefix: "Donation",
    route_path: "donation",

    select_fields: [
        "id",
        "first_name",
            "last_name",
            "email",
            "number",
            "address_1",
            "address_2",
            "city",
            "state",
            "payment_method",
            "amount",
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
            "number",
            "address_1",
            "address_2",
            "city",
            "state",
            "payment_method",
            "amount",
        "status",
        "created_at",
    ],
    table_header_data: [
        "id",
        "first_name",
            "last_name",
            "email",
            "number",
            "address_1",
            "address_2",
            "city",
            "state",
            "payment_method",
            "amount",
        "status",
        "created_at",
    ],
    table_row_data: [
        "id",
        "first_name",
            "last_name",
            "email",
            "number",
            "address_1",
            "address_2",
            "city",
            "state",
            "payment_method",
            "amount",
        "status",
        "created_at",
    ],
    quick_view_data: [
        "id",
        "first_name",
            "last_name",
            "email",
            "number",
            "address_1",
            "address_2",
            "city",
            "state",
            "payment_method",
            "amount",
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
