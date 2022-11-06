import { useState } from 'react';

const VendorRegistrationForm = () => {
  const [formData, setFormData] = useState();

  return (
    <form>
      <input name="fname"></input>
      <input name="lname"></input>
      <input name="pname"></input>
      <input name="dba"></input>
      <input name="pronouns"></input>
      <input name="TIN"></input>
      <input name="street"></input>
      <input name="city"></input>
      <input name="state"></input>
      <input name="zip"></input>
      <input name="country"></input>
      <input name="phone"></input>
      <input name="segments"></input>
      <input name=""></input>
      <input name=""></input>
    </form>
  );
};

export default VendorRegistrationForm;
