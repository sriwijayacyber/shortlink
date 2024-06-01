import axios from "axios";
import Input from "../Input";
import EditPen from "../Icons/EditPen";
import { useForm, usePage } from "@inertiajs/react";
import { FormEventHandler, useState } from "react";
import { LinkProps, PageProps, PaginationProps } from "@/types";
import { Button, Dialog, IconButton } from "@material-tailwind/react";
import { error, success } from "@/utils/toast";

interface Props {
   link: LinkProps;
   links: PaginationProps;
   setLinks: (res: PaginationProps) => void;
}

const EditLink = (props: Props) => {
   const page = usePage<PageProps>();
   const { app, input } = page.props.translate;
   const { link, links, setLinks } = props;
   const [open, setOpen] = useState(false);
   const [newUrlName, setNewUrlName] = useState(false);

   const handleOpen = () => {
      setOpen((prev) => !prev);
   };

   const { data, setData } = useForm({
      link_name: link.link_name,
      link_type: "biolink",
      url_name: link.url_name,
   });

   const onHandleChange = (event: any) => {
      setData(event.target.name, event.target.value);
      if (event.target.name === "url_name") {
         if (event.target.value === link.url_name) {
            setNewUrlName(false);
         } else {
            setNewUrlName(true);
         }
      }
   };

   const [errors, setErrors] = useState({
      link_name: null,
      url_name: null,
   });

   const submit: FormEventHandler = async (e) => {
      e.preventDefault();
      setErrors({
         link_name: null,
         url_name: null,
      });

      try {
         const newData = { ...data, new_url: newUrlName };
         const res = await axios.patch(`/bio-links/update/${link.id}`, newData);
         if (res.data.error) {
            error(res.data.error);
         } else if (res.data.success && res.data.link) {
            handleOpen();
            success(res.data.success);

            const updatedLinks = links.data.map((item) => {
               return item.id === res.data.link.id
                  ? { ...item, link_name: res.data.link.link_name }
                  : item;
            });

            setLinks({
               ...links,
               data: updatedLinks,
            });
         }
      } catch (error: any) {
         const { link_name, url_name } = error.response.data.errors;
         if (link_name)
            setErrors((prev: any) => ({ ...prev, link_name: link_name[0] }));
         if (url_name)
            setErrors((prev: any) => ({
               ...prev,
               url_name: url_name[0],
            }));
      }
   };

   return (
      <>
         <IconButton
            variant="text"
            color="white"
            onClick={handleOpen}
            className="w-7 h-7 rounded-full bg-blue-50 hover:bg-blue-50 active:bg-blue-50 text-blue-500"
         >
            <EditPen className="h-4 w-4" />
         </IconButton>

         <Dialog
            size="sm"
            open={open}
            handler={handleOpen}
            className="p-6 max-h-[calc(100vh-80px)] overflow-y-auto text-gray-800"
         >
            <div className="flex items-center justify-between mb-6">
               <p className="text-xl font-medium">{app.update_link}</p>
               <span
                  onClick={handleOpen}
                  className="text-3xl leading-none cursor-pointer"
               >
                  ×
               </span>
            </div>

            <form onSubmit={submit}>
               <div className="mb-4">
                  <Input
                     type="text"
                     name="link_name"
                     label={input.bio_link_name}
                     value={data.link_name}
                     error={errors.link_name}
                     onChange={onHandleChange}
                     placeholder={input.bio_link_name_placeholder}
                     fullWidth
                     required
                  />
               </div>
               <div className="mb-4">
                  <Input
                     type="text"
                     name="url_name"
                     label={input.link_username}
                     value={data.url_name}
                     error={errors.url_name}
                     onChange={onHandleChange}
                     placeholder={input.link_username_placeholder}
                     fullWidth
                     required
                  />
               </div>

               <div className="flex justify-end mt-4">
                  <Button
                     color="red"
                     variant="text"
                     onClick={handleOpen}
                     className="py-2 font-medium capitalize text-base mr-2"
                  >
                     <span>{app.cancel}</span>
                  </Button>
                  <Button
                     type="submit"
                     color="blue"
                     variant="gradient"
                     className="py-2 font-medium capitalize text-base"
                  >
                     <span>{app.save_changes}</span>
                  </Button>
               </div>
            </form>
         </Dialog>
      </>
   );
};

export default EditLink;
