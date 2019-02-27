import $ from 'jquery';
import Foundation from 'foundation-sites';

const dropdownApps = new Foundation.Dropdown($('#apps'), {
  postition: 'bottom',
  alignment: 'center',
});
const dropdownNotifications = new Foundation.Dropdown($('#notifications'), {
  postition: 'bottom',
  alignment: 'center',
});
const dropdownUser = new Foundation.Dropdown($('#user'), {
  postition: 'bottom',
  alignment: 'center',
});

export {
  dropdownApps,
  dropdownNotifications,
  dropdownUser
}
