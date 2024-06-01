import Input from "@/Components/Input";
import { useForm, usePage } from "@inertiajs/react";
import Switch from "@/Components/Switch";
import { Button } from "@material-tailwind/react";
import { PageProps, PaymentProps } from "@/types";

const RazorpaySettings = (props: { razorpay: PaymentProps }) => {
   const page = usePage<PageProps>();
   const { app, input } = page.props.translate;

   const { active, key, secret } = props.razorpay;
   const { data, setData, patch, errors, clearErrors } = useForm({
      allow_razorpay: active,
      razorpay_key: key,
      razorpay_secret: secret,
   });

   const onHandleChange = (
      event: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>
   ) => {
      const target = event.target as HTMLInputElement;

      setData({
         ...data,
         [target.name]:
            target.type === "checkbox" ? target.checked : target.value,
      });
   };

   const submit = (e: React.FormEvent) => {
      e.preventDefault();
      clearErrors();
      patch(route("payment.razorpay"));
   };

   return (
      <div className="card max-w-[1000px] w-full mx-auto mt-7">
         <div className="px-7 pt-7 pb-4 border-b border-b-gray-200">
            <p className="text18 font-bold text-gray-900">
               {app.razorpay_payment_gateway}
            </p>
         </div>
         <form onSubmit={submit} className="p-7">
            <div className="mb-7 md:pl-[164px]">
               <Switch
                  switchId="razorpay"
                  name="allow_razorpay"
                  label={input.allow_razorpay}
                  defaultChecked={data.allow_razorpay}
                  onChange={onHandleChange}
               />
            </div>
            <div className="mb-7">
               <Input
                  fullWidth
                  type="password"
                  name="razorpay_key"
                  value={data.razorpay_key}
                  error={errors.razorpay_key}
                  placeholder={input.razorpay_api_key_placeholder}
                  onChange={onHandleChange}
                  label={input.razorpay_api_key}
                  flexLabel
                  required
               />
            </div>

            <div className="mb-7">
               <Input
                  fullWidth
                  type="password"
                  name="razorpay_secret"
                  value={data.razorpay_secret}
                  error={errors.razorpay_secret}
                  placeholder={input.razorpay_api_secret_placeholder}
                  onChange={onHandleChange}
                  label={input.razorpay_api_secret}
                  flexLabel
                  required
               />
            </div>

            <div className="flex items-center mt-6 md:pl-[164px]">
               <Button
                  type="submit"
                  color="blue"
                  variant="gradient"
                  className="py-2.5 px-5 rounded-md font-medium capitalize text-sm hover:shadow-md"
               >
                  {app.save_changes}
               </Button>
            </div>
         </form>
      </div>
   );
};

export default RazorpaySettings;
