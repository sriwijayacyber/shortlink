import React from "react";
import Input from "@/Components/Input";
import { useForm, usePage } from "@inertiajs/react";
import { Button } from "@material-tailwind/react";
import Switch from "@/Components/Switch";
import { PageProps, SocialLoginProps } from "@/types";

const GoogleAuthSettings = (props: { google: SocialLoginProps }) => {
   const page = usePage<PageProps>();
   const { app, input } = page.props.translate;

   const { active, client_id, client_secret, redirect_url } = props.google;
   const boolValue: boolean = !!parseInt(active);

   const { data, setData, patch, errors, clearErrors } = useForm({
      google_login_allow: boolValue,
      google_client_id: client_id,
      google_client_secret: client_secret,
      google_redirect: redirect_url,
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
      patch(route("settings.google"));
   };

   return (
      <div className="card max-w-[1000px] w-full mx-auto my-7">
         <div className="px-7 pt-7 pb-4 border-b border-b-gray-200">
            <p className="text18 font-bold text-gray-900">
               {app.google_auth_settings}
            </p>
         </div>

         <form onSubmit={submit} className="p-7">
            <div className="mb-7 md:pl-[164px]">
               <Switch
                  switchId="google"
                  name="google_login_allow"
                  label={input.allow_google_login}
                  onChange={onHandleChange}
                  defaultChecked={data.google_login_allow}
               />
            </div>

            <div className="mb-7">
               <Input
                  fullWidth
                  type="password"
                  name="google_client_id"
                  value={data.google_client_id}
                  error={errors.google_client_id}
                  placeholder={input.google_client_id_placeholder}
                  onChange={onHandleChange}
                  label={input.google_client_id}
                  flexLabel
                  required
               />
            </div>

            <div className="mb-7">
               <Input
                  fullWidth
                  type="password"
                  name="google_client_secret"
                  value={data.google_client_secret}
                  error={errors.google_client_secret}
                  placeholder={input.google_client_secret_placeholder}
                  onChange={onHandleChange}
                  label={input.google_client_secret}
                  flexLabel
                  required
               />
            </div>

            <div className="mb-7">
               <Input
                  type="text"
                  fullWidth
                  name="google_redirect"
                  value={data.google_redirect}
                  error={errors.google_redirect}
                  placeholder={input.google_redirect_url_placeholder}
                  onChange={onHandleChange}
                  label={input.google_redirect_url}
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

export default GoogleAuthSettings;
