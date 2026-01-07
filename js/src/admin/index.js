import app from 'flarum/admin/app';

app.initializers.add('huoxin/relative-url', () => {
  app.extensionData.for('huoxin-relative-url').registerSetting({
    setting: 'huoxin-relative-url.internal_domains',
    label: app.translator.trans('huoxin-relative-url.admin.internal_domains_label'),
    help: app.translator.trans('huoxin-relative-url.admin.internal_domains_help'),
    type: 'textarea',
    rows: 8,
    placeholder: app.translator.trans('huoxin-relative-url.admin.internal_domains_placeholder'),
  });
});
