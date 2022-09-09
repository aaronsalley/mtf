export const wpContent = async () => {
  const home = `pageBy(uri: "/") {
    title,
    content,
    excerpt,
    featuredImage {
      node {
        mediaType,
        mediaItemUrl,
        altText
      }
    }
  }`;
  const pages = `pages(where: {status: PUBLISH}, first: 100) {
    nodes {
      uri,
      id
    }
  }`;
  const events = `events(where: {status: PUBLISH}, first: 100) {
    nodes {
      id,
      title,
      excerpt,
      uri,
      slug,
      featuredImage {
        node {
          sourceUrl
        }
      }    
    }
  }`;
  const posts = `posts(where: {status: PUBLISH}) {
    nodes {
      date,
      title,
      slug,
      excerpt
    }
  }`;
  // TODO: fetch state consts
  const megaMenuItems = `menuItems(where: {location: MEGA, parentId: ""}, first: 1000) {
    nodes {
      label,
      title,
      target,
      path,
      childItems {
        nodes {
          label,
          title,
          target,
          path,
        }
      }
    }
  }`;
  const navItems = `navItems: menuItems(where: {location: NAV, parentId: ""}, first: 1000) {
    nodes {
      label,
      title,
      target,
      path,
    }
  }`;

  try {
    const url =
      typeof window !== 'undefined'
        ? process.env.NEXT_PUBLIC_API_URL
        : process.env.API_URL;
    const query = `{
    ${megaMenuItems},
    ${navItems},
    ${home},
    ${pages},
    ${events},
    ${posts}
  }`.replaceAll(/\s/gi, '');

    const res = await fetch(url + `/graphql?query=${query}`, {
      // headers: {
      //   'Content-Type': 'application/json',
      // },
    });

    const json = await res.json();
    if (json.errors)
      json.errors.map((error: any) => {
        throw Error(error);
      });

    return json.data;
  } catch (error: any) {
    console.error(error);

    return {
      notFound: true,
    };
  }
};
