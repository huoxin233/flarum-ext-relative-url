import Extend from 'flarum/common/extenders';
import app from 'flarum/admin/app';

export default [
  new Extend.Admin()
    .setting(
      () => ({
        setting: 'huoxin-relative-url.internal_domains',
        label: app.translator.trans('huoxin-relative-url.admin.internal_domains_label'),
        help: app.translator.trans('huoxin-relative-url.admin.internal_domains_help'),
        type: 'textarea',
        rows: 8,
        placeholder: app.translator.trans('huoxin-relative-url.admin.internal_domains_placeholder'),
      }),
    )
];