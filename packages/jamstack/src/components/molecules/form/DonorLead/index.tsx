import { useState } from 'react';

const DonorLeadForm = () => {
  const [formData, setFormData] = useState();

  return (
    <form>
      <input name="fname"></input>
      <input name="lname"></input>
      <input name="email"></input>
    </form>
  );
};

export default DonorLeadForm;
