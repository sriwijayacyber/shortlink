import { SVGProps } from "react-html-props";

const Download = (props: SVGProps) => {
   return (
      <svg
         xmlns="http://www.w3.org/2000/svg"
         height="1em"
         viewBox="0 0 384 512"
         {...props}
      >
         <path
            fill="currentColor"
            d="M32 480c-17.7 0-32-14.3-32-32s14.3-32 32-32H352c17.7 0 32 14.3 32 32s-14.3 32-32 32H32zM214.6 342.6c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 242.7V64c0-17.7 14.3-32 32-32s32 14.3 32 32V242.7l73.4-73.4c12.5-12.5 32.8-12.5 45.3 0s12.5 32.8 0 45.3l-128 128z"
         />
      </svg>
   );
};

export default Download;
